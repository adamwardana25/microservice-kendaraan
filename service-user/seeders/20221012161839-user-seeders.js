"use strict";
const bcrypt = require("bcrypt");
/** @type {import('sequelize-cli').Migration} */
module.exports = {
  async up(queryInterface, Sequelize) {
    await queryInterface.bulkInsert(
      "users",
      [
        {
          name: "elon",
          profession: "Admin Micro",
          role: "admin",
          email: "elon@gmail.com",
          password: await bcrypt.hash("rahasia123", 10),
          created_at: new Date(),
          updated_at: new Date(),
        },
        {
          name: "jackma",
          profession: "Wiraswasta",
          role: "customer",
          email: "jackma@gmail.com",
          password: await bcrypt.hash("rahasia123", 10),
          created_at: new Date(),
          updated_at: new Date(),
        },
      ],
      {}
    );
  },

  async down(queryInterface, Sequelize) {
    await queryInterface.bulkDelete("users", null, {});
  },
};
