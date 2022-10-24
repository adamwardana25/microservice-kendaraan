var express = require("express");
var router = express.Router();

const transactionsHandler = require("./handler/transactions");

router.get("/", transactionsHandler.getTransactions);
router.post("/", transactionsHandler.create);
router.put("/:id", transactionsHandler.update);

module.exports = router;
