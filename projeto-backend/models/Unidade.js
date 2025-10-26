const { DataTypes } = require('sequelize');
const sequelize = require('../config/database');
const bcrypt = require('bcryptjs');

const Unidade = sequelize.define('Unidade', {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true
  },
  numero: {
    type: DataTypes.STRING(10),
    allowNull: false,
    unique: true
  },
  senha: {
    type: DataTypes.STRING(255),
    allowNull: false
  },
  isAdmin: {
    type: DataTypes.BOOLEAN,
    defaultValue: false,
    allowNull: false
  },
  proprietario: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  email: {
    type: DataTypes.STRING(100),
    allowNull: true
  },
  telefone: {
    type: DataTypes.STRING(20),
    allowNull: true
  }
}, {
  tableName: 'unidades',
  hooks: {
    beforeCreate: async (unidade) => {
      if (unidade.senha) {
        unidade.senha = await bcrypt.hash(unidade.senha, 10);
      }
    },
    beforeUpdate: async (unidade) => {
      if (unidade.changed('senha')) {
        unidade.senha = await bcrypt.hash(unidade.senha, 10);
      }
    }
  }
});

// Método para comparar senha
Unidade.prototype.validarSenha = async function(senha) {
  return await bcrypt.compare(senha, this.senha);
};

module.exports = Unidade;