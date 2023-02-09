import { Payment } from "@mui/icons-material";
import React from "react";

const PaymentMethodTemplate = () => {
  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center">
          <Payment className="text-2xl" />
          <h2 className="text-2xl">Payment Methods</h2>
        </div>
      </div>
    </div>
  );
};

export default PaymentMethodTemplate;
