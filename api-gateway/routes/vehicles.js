const express = require("express");
const router = express.Router();

const vehiclesHandler = require("./handler/vehicles");

const verifyToken = require("../middlewares/verifyToken");

router.get("/", vehiclesHandler.getAll);
router.get("/:id", vehiclesHandler.get);
router.post("/", verifyToken, vehiclesHandler.create);
router.put("/:id", verifyToken, vehiclesHandler.update);
router.delete("/:id", verifyToken, vehiclesHandler.destroy);

module.exports = router;
