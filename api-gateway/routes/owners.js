const express = require("express");
const router = express.Router();

const ownersHandler = require("./handler/owners");

router.get("/", ownersHandler.getAll);
router.get("/:id", ownersHandler.get);
router.post("/", ownersHandler.create);
router.put("/:id", ownersHandler.update);
router.delete("/:id", ownersHandler.destroy);

module.exports = router;
