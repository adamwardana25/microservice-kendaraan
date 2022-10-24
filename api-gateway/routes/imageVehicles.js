const express = require("express");
const router = express.Router();

const imageVehiclesHandler = require("./handler/image-vehicles");

router.post("/", imageVehiclesHandler.create);
router.delete("/:id", imageVehiclesHandler.destroy);

module.exports = router;
