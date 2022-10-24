const apiAdapter = require("../../apiAdapter");
const { URL_SERVICE_VEHICLE } = process.env;
const api = apiAdapter(URL_SERVICE_VEHICLE);

module.exports = async (req, res) => {
  try {
    const imageVehicle = await api.post("/api/image-vehicles", req.body);
    return res.json(imageVehicle.data);
  } catch (error) {
    if (error.code === "ECONNREFUSED") {
      return res
        .status(500)
        .json({ status: "error", message: "service unavailable" });
    }
    const { status, data } = error.response;
    return res.status(status).json(data);
  }
};
