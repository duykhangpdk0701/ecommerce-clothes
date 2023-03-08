import { ICheckoutParams } from "@/pages/checkout";
import React, { FC } from "react";
import { Control } from "react-hook-form/dist/types";

interface ICheckoutComment {
  control: Control<ICheckoutParams, any>;
}

const CheckoutComment: FC<ICheckoutComment> = (props) => {
  const { control } = props;
  return <div>CheckoutComment</div>;
};

export default CheckoutComment;
