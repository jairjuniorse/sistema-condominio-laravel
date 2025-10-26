const sequelize = require('../config/database');
const Unidade = require('../models/Unidade');
require('dotenv').config();

async function createInitialUnits() {
  try {
    // Sincronizar o banco (criar tabelas se não existirem)
    await sequelize.sync({ force: false });
    console.log('✅ Tabelas sincronizadas');

    // Criar unidade admin/síndico
    const [admin, adminCreated] = await Unidade.findOrCreate({
      where: { numero: 'SINDICO' },
      defaults: {
        senha: 'admin123',
        isAdmin: true,
        proprietario: 'Síndico do Condomínio',
        email: 'sindico@condominio.com',
        telefone: '(11) 99999-9999'
      }
    });

    if (adminCreated) {
      console.log('✅ Síndico criado - Unidade: SINDICO, Senha: admin123');
    } else {
      console.log('⚠️ Síndico já existe');
    }

    // Criar algumas unidades de exemplo
    const unidadesExemplo = [
      { 
        numero: 'D201', 
        senha: '1234',
        proprietario: 'João Silva',
        email: 'joao.d201@email.com',
        telefone: '(11) 98888-8888'
      },
      { 
        numero: 'D202', 
        senha: '1234',
        proprietario: 'Maria Santos',
        email: 'maria.d202@email.com',
        telefone: '(11) 97777-7777'
      },
      { 
        numero: 'D101', 
        senha: '1234',
        proprietario: 'Pedro Oliveira',
        email: 'pedro.d101@email.com',
        telefone: '(11) 96666-6666'
      }
    ];

    for (const unidade of unidadesExemplo) {
      const [unidadeCriada, foiCriada] = await Unidade.findOrCreate({
        where: { numero: unidade.numero },
        defaults: {
          senha: unidade.senha,
          isAdmin: false,
          proprietario: unidade.proprietario,
          email: unidade.email,
          telefone: unidade.telefone
        }
      });

      if (foiCriada) {
        console.log(`✅ Unidade ${unidade.numero} criada - Senha: ${unidade.senha}`);
      } else {
        console.log(`⚠️ Unidade ${unidade.numero} já existe`);
      }
    }

    console.log('\n🎉 Unidades iniciais criadas com sucesso!');
    console.log('\n📋 Credenciais para teste:');
    console.log('Síndico: Unidade: SINDICO, Senha: admin123');
    console.log('Morador: Unidade: D201, Senha: 1234');
    
    process.exit(0);
  } catch (error) {
    console.error('❌ Erro ao criar unidades iniciais:', error);
    process.exit(1);
  }
}

createInitialUnits();