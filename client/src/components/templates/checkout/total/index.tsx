import Divider from "@mui/material/Divider";
import React from "react";

const CheckoutTotal = () => {
  return (
    <div>
      <p className="mb-4 text-sm font-bold">Your Order</p>
      <div className="flex items-center justify-between mb-3">
        <p className="text-sm">
          <span className="font-bold">1</span> x IPhone 12
        </p>
        <p>999,00 USD</p>
      </div>
      <div className="flex items-center justify-between mb-3">
        <p className="text-sm">
          <span className="font-bold">1</span> x IPhone 12
        </p>
        <p>999,00 USD</p>
      </div>
      <div className="flex items-center justify-between mb-3">
        <p className="text-sm">
          <span className="font-bold">1</span> x IPhone 12
        </p>
        <p>999,00 USD</p>
      </div>

      <Divider className="my-6" />

      <div className="flex items-center justify-between mb-1">
        <p>Subtotal:</p>
        <p className="text-sm font-bold">999,00 USD</p>
      </div>

      <div className="flex items-center justify-between mb-1">
        <p>Shipping:</p>
        <p className="text-sm font-bold">999,00 USD</p>
      </div>

      <div className="flex items-center justify-between mb-1">
        <p>Tax:</p>
        <p className="text-sm font-bold">999,00 USD</p>
      </div>

      <div className="flex items-center justify-between mb-6">
        <p>Discount:</p>
        <p className="text-sm font-bold">999,00 USD</p>
      </div>
      <Divider className="mb-2" />
      <div className="flex items-center justify-between mb-6">
        <p className="text-sm font-bold">Total</p>
        <p className="text-sm font-bold">999,00 USD</p>
      </div>
    </div>
  );
};

export default CheckoutTotal;
