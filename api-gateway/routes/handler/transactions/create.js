const apiAdapter = require("../../apiAdapter");
const { URL_SERVICE_TRANSACTION } = process.env;
const api = apiAdapter(URL_SERVICE_TRANSACTION);

module.exports = async (req, res) => {
  try {
    const transaction = await api.post("/api/transactions", req.body);
    return res.json(transaction.data);
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
