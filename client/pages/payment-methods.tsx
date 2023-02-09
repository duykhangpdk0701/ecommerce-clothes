import PaymentMethodTemplate from "@/components/templates/payment-methods";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement } from "react";

const PaymentMethod = () => {
  return <PaymentMethodTemplate />;
};

PaymentMethod.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default PaymentMethod;
