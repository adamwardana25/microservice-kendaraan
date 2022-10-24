const apiAdapter = require("../../apiAdapter");
const { URL_SERVICE_VEHICLE } = process.env;
const api = apiAdapter(URL_SERVICE_VEHICLE);

module.exports = async (req, res) => {
  try {
    const id = req.params.id;
    const vehicle = await api.delete(`/api/vehicles/${id}`);
    return res.json(vehicle.data);
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
