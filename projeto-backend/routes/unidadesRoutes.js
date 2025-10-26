const express = require('express');
const { authMiddleware, adminMiddleware } = require('../middleware/authMiddleware');
const Unidade = require('../models/Unidade');

const router = express.Router();

// Aplicar middleware de autenticação em todas as rotas
router.use(authMiddleware);

// Rota para obter todas as unidades (apenas admin/síndico)
router.get('/', adminMiddleware, async (req, res) => {
  try {
    const unidades = await Unidade.findAll({
      attributes: { exclude: ['senha'] } // Não retornar senhas
    });
    
    res.json({
      success: true,
      data: unidades
    });
  } catch (error) {
    console.error('Erro ao buscar unidades:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Erro ao buscar unidades' 
    });
  }
});

// Rota para dados da própria unidade (qualquer unidade autenticada)
router.get('/minha-unidade', async (req, res) => {
  try {
    const unidade = await Unidade.findByPk(req.unidade.id, {
      attributes: { exclude: ['senha'] }
    });
    
    if (!unidade) {
      return res.status(404).json({ 
        success: false, 
        message: 'Unidade não encontrada' 
      });
    }

    res.json({
      success: true,
      data: unidade
    });
  } catch (error) {
    console.error('Erro ao buscar unidade:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Erro ao buscar unidade' 
    });
  }
});

// Rota para criar nova unidade (apenas admin)
router.post('/', adminMiddleware, async (req, res) => {
  try {
    const { numero, senha, proprietario, email, telefone, isAdmin } = req.body;
    
    const novaUnidade = await Unidade.create({
      numero: numero.toUpperCase().trim(),
      senha,
      proprietario,
      email,
      telefone,
      isAdmin: isAdmin || false
    });

    res.status(201).json({
      success: true,
      message: 'Unidade criada com sucesso',
      data: {
        id: novaUnidade.id,
        numero: novaUnidade.numero,
        proprietario: novaUnidade.proprietario,
        isAdmin: novaUnidade.isAdmin
      }
    });
  } catch (error) {
    console.error('Erro ao criar unidade:', error);
    
    if (error.name === 'SequelizeUniqueConstraintError') {
      return res.status(400).json({
        success: false,
        message: 'Já existe uma unidade com este número'
      });
    }
    
    res.status(500).json({
      success: false,
      message: 'Erro ao criar unidade'
    });
  }
});

module.exports = router;