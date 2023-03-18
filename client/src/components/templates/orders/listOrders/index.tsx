import ShoppingBagIcon from "@mui/icons-material/ShoppingBag";
import Pagination from "@mui/material/Pagination";
import React, { FC } from "react";
import { TEXT_COLOR_GRAY } from "@/styles/color";
import ListOrderItems from "./ListOrderItems";
import IOrder from "@/interfaces/Order";
import ListOrderItemLoading from "./ListOrderItemLoading";

interface IListOrdersTemplate {
  data?: IOrder[];
  loading: boolean;
}

const loadingItem = [
  <ListOrderItemLoading />,
  <ListOrderItemLoading />,
  <ListOrderItemLoading />,
  <ListOrderItemLoading />,
  <ListOrderItemLoading />,
];

const ListOrdersTemplate: FC<IListOrdersTemplate> = (props) => {
  const { data, loading } = props;

  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center">
          <ShoppingBagIcon className="text-2xl text-color-price" />
          <h2 className="text-2xl">My Orders</h2>
        </div>
      </div>
      <div className="mx-4 flex">
        <h5 className="flex-1 text-base" style={{ color: TEXT_COLOR_GRAY }}>
          Order #
        </h5>
        <h5 className="flex-1 text-base" style={{ color: TEXT_COLOR_GRAY }}>
          Status
        </h5>
        <h5 className="flex-1 text-base" style={{ color: TEXT_COLOR_GRAY }}>
          Date purchase
        </h5>
        <h5 className="flex-1 text-base" style={{ color: TEXT_COLOR_GRAY }}>
          Total
        </h5>
        <h5 className="mx-[22px]"></h5>
      </div>

      {loading
        ? loadingItem
        : data?.map((item) => (
            <ListOrderItems
              id={item.id}
              orderCode={item.order_code}
              key={item.id}
              total={item.total}
              dateCreate={item.created_at}
              status={item.order_status_id}
            />
          ))}

      <div className="mt-10 flex justify-center">
        {data
          ? data?.length > 5 && (
              <Pagination count={5} variant="outlined" color="primary" />
            )
          : null}
      </div>
    </div>
  );
};

export default ListOrdersTemplate;
