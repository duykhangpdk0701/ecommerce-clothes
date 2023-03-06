import React from "react";
import Paper from "@mui/material/Paper";
import Avatar from "@mui/material/Avatar";

const CheckoutFormPayment = () => {
  return (
    <Paper className="mb-6 py-6 px-7" elevation={1}>
      <div className="flex mb-7 gap-3 items-center">
        <Avatar className="bg-color-price w-8 h-8">1</Avatar>
        <p className="text-xl">Delivery Address</p>
      </div>
    </Paper>
  );
};

export default CheckoutFormPayment;
