const { Sequelize } = require('sequelize');
require('dotenv').config();

const sequelize = new Sequelize(
  process.env.DB_NAME,
  process.env.DB_USER,
  process.env.DB_PASSWORD,
  {
    host: process.env.DB_HOST,
    port: process.env.DB_PORT,
    dialect: 'mysql',
    logging: console.log,
  }
);

// Testar conexão
async function testConnection() {
  try {
    await sequelize.authenticate();
    console.log('✅ Conexão com o banco de dados estabelecida com sucesso!');
  } catch (error) {
    console.error('❌ Erro ao conectar com o banco de dados:', error.message);
    console.log('💡 Verifique se:');
    console.log('   1. O MySQL está rodando no XAMPP');
    console.log('   2. O banco "condominio_db" existe');
    console.log('   3. As credenciais no .env estão corretas');
  }
}

testConnection();

module.exports = sequelize;