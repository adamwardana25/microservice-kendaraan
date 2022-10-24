const apiAdapter = require("../../apiAdapter");
const { URL_SERVICE_VEHICLE, HOSTNAME } = process.env;
const api = apiAdapter(URL_SERVICE_VEHICLE);

module.exports = async (req, res) => {
  try {
    const vehicles = await api.get("/api/vehicles", {
      params: {
        ...req.query,
      },
    });

    const vehiclesData = vehicles.data;
    const firstPage = vehiclesData.data.first_page_url.split("?").pop();
    const lastPage = vehiclesData.data.last_page_url.split("?").pop();

    vehiclesData.data.first_page_url = `${HOSTNAME}/vehicles?${firstPage}`;
    vehiclesData.data.last_page_url = `${HOSTNAME}/vehicles?${lastPage}`;

    if (vehiclesData.data.next_page_url) {
      const nextPage = vehiclesData.data.next_page_url.split("?").pop();
      vehiclesData.data.next_page_url = `${HOSTNAME}/vehicles/${nextPage}`;
    }

    if (vehiclesData.data.prev_page_url) {
      const prevPage = vehiclesData.data.prev_page_url.split("?").pop();
      vehiclesData.data.prev_page_url = `${HOSTNAME}/vehicles/${prevPage}`;
    }

    vehiclesData.data.path = `${HOSTNAME}/vehicles`;

    return res.json(vehiclesData);
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
