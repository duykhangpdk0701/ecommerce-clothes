import PaymentIcon from "@mui/icons-material/Payment";
import React from "react";

const PaymentMethodTemplate = () => {
  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center">
          <PaymentIcon className="text-2xl text-color-price" />
          <h2 className="text-2xl">Payment Methods</h2>
        </div>
      </div>
    </div>
  );
};

export default PaymentMethodTemplate;
