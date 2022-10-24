const apiAdapter = require("../../apiAdapter");
const { URL_SERVICE_TRANSACTION } = process.env;
const api = apiAdapter(URL_SERVICE_TRANSACTION);

module.exports = async (req, res) => {
  try {
    // const id = req.params.id;
    // const transaction = await api.put(`/api/transactions/${id}`, req.body);

    const userId = req.user.id;
    // const transaction = await api.put(`/api/transactions/${id}`, req.body);
    const transaction = await api.put(`/api/transactions/${userId}`, {
      params: { user_id: userId },
    });
    return res.json(transaction.data);
  } catch (error) {
    if (error.code === "ECONNREFUSED") {
      return res
        .status(500)
        .json({ status: "error", message: "transaction unavailable" });
    }
    const { status, data } = error.response;
    return res.status(status).json(data);
  }
};
