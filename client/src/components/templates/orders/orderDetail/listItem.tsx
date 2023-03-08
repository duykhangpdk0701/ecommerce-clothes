import React, { FC } from "react";
import Paper from "@mui/material/Paper";
import IProduct from "@/interfaces/Product";
import IOrder, { IOrderItem } from "@/interfaces/Order";
import { LazyLoadImage } from "react-lazy-load-image-component";
import Typography from "@mui/material/Typography";
import moment from "moment";

interface IOrderDetailListItem {
  listItem?: IOrderItem[];
  id?: number;
  placeOn?: string;
}

const OrderDetailListItem: FC<IOrderDetailListItem> = (props) => {
  const { listItem, id, placeOn } = props;

  return (
    <Paper>
      <div className="p-3 flex bg-[#f3f5f9]">
        <div className="flex-1 flex">
          <p className="mr-1 text-color-gray">Order ID:</p> <p>{id}</p>
        </div>
        <div className="flex-1 flex">
          <p className="mr-1 text-color-gray">Place On:</p>
          <p>{moment(placeOn).format("MMM Do YY")}</p>
        </div>
      </div>
      <div className="py-2">
        {listItem?.map((item) => (
          <div className="my-2 mx-4 flex flex-wrap">
            <div className="m-1.5 flex-[260px] flex items-center">
              <div className="w-16 h-16">
                <LazyLoadImage src={item.item.thumbnail_url} />
              </div>
              <div className="ml-5">
                <Typography variant="h6" className="text-sm">
                  {item.item_name}
                </Typography>
                <p>
                  {item.price} US$ x {item.quantity}
                </p>
              </div>
            </div>
            <div className="m-1.5 flex-[260px] flex items-center">
              <p>Product properties: Black, L</p>
            </div>
          </div>
        ))}
      </div>
    </Paper>
  );
};

export default OrderDetailListItem;
