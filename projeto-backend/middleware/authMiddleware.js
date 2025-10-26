const jwt = require('jsonwebtoken');
const Unidade = require('../models/Unidade');

const JWT_SECRET = process.env.JWT_SECRET;

const authMiddleware = async (req, res, next) => {
  try {
    const token = req.header('Authorization')?.replace('Bearer ', '');
    
    if (!token) {
      return res.status(401).json({ 
        success: false, 
        message: 'Acesso negado. Token necessário.' 
      });
    }

    const decoded = jwt.verify(token, JWT_SECRET);
    
    // Verificar se a unidade ainda existe
    const unidade = await Unidade.findByPk(decoded.id);
    if (!unidade) {
      return res.status(401).json({ 
        success: false, 
        message: 'Token inválido. Unidade não encontrada.' 
      });
    }

    req.unidade = decoded;
    next();
  } catch (error) {
    console.error('Erro na autenticação:', error);
    res.status(401).json({ 
      success: false, 
      message: 'Token inválido.' 
    });
  }
}

const adminMiddleware = async (req, res, next) => {
  try {
    if (!req.unidade.isAdmin) {
      return res.status(403).json({ 
        success: false, 
        message: 'Acesso restrito ao síndico/admin.' 
      });
    }
    next();
  } catch (error) {
    res.status(403).json({ 
      success: false, 
      message: 'Acesso negado.' 
    });
  }
}

module.exports = { authMiddleware, adminMiddleware, JWT_SECRET };