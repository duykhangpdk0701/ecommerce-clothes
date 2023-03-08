import React, { FC, ReactElement } from "react";
import Link from "next/link";
import ShoppingBagIcon from "@mui/icons-material/ShoppingBag";

interface IListOrdersTemplate {
  deliveryProgress: ReactElement;
  listItem: ReactElement;
  infor: ReactElement;
}

const OrderDetailTemplate: FC<IListOrdersTemplate> = (props) => {
  const { deliveryProgress, listItem, infor } = props;
  return (
    <div>
      <div className="mt-4 mb-6 flex justify-between">
        <div className="flex gap-3 items-center">
          <ShoppingBagIcon className="text-2xl text-color-price" />
          <h2 className="text-2xl">Order Details</h2>
        </div>
      </div>
      <div className="mb-7">{deliveryProgress}</div>

      <div className="mb-7">{listItem}</div>

      <div>{infor}</div>
    </div>
  );
};

export default OrderDetailTemplate;
