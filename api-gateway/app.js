require("dotenv").config();
const express = require("express");
const path = require("path");
const cookieParser = require("cookie-parser");
const logger = require("morgan");

const indexRouter = require("./routes/index");
const usersRouter = require("./routes/users");
const mediaRouter = require("./routes/media");
const transactionsRouter = require("./routes/transactions");
// const paymentsRouter = require("./routes/payments");
const vehiclesRouter = require("./routes/vehicles");
const refreshTokenRouter = require("./routes/refreshTokens");
const ownersRouter = require("./routes/owners");
const imageVehiclesRouter = require("./routes/imageVehicles");

const verifyToken = require("./middlewares/verifyToken");

const app = express();

app.use(logger("dev"));
app.use(express.json({ limit: "50mb" }));
app.use(express.urlencoded({ extended: false, limit: "50mb" }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, "public")));

app.use("/", indexRouter);
app.use("/users", usersRouter);
app.use("/media", mediaRouter);
app.use("/transactions", verifyToken, transactionsRouter);
// app.use("/payments", paymentsRouter);
app.use("/vehicles", vehiclesRouter);
app.use("/refresh-tokens", refreshTokenRouter);
app.use("/owners", verifyToken, ownersRouter);
app.use("/image-vehicles", verifyToken, imageVehiclesRouter);

module.exports = app;
