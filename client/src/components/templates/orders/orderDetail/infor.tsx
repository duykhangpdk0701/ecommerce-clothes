import Paper from "@mui/material/Paper";
import Grid from "@mui/material/Grid";
import Divider from "@mui/material/Divider";

import React, { FC } from "react";

interface IOrderDetailInfo {
  address?: string;
  addressToString?: string;
  subtotal?: string;
  shippingCost?: string;
  discount?: string;
  total?: string;
}

const OrderDetailInfo: FC<IOrderDetailInfo> = (props) => {
  const { address, addressToString, subtotal, shippingCost, discount, total } =
    props;
  return (
    <div>
      <Grid container spacing={3}>
        <Grid item xs={12} md={6} lg={6}>
          <Paper className="py-5 px-[30px]">
            <h5 className="mb-4 text-base font-semibold">Shipping Address</h5>
            <p className="text-sm">{address}</p>
          </Paper>
        </Grid>
        <Grid item xs={12} md={6} lg={6}>
          <Paper className="py-5 px-[30px]">
            <h5 className="mb-4 text-base font-semibold">Total Summary</h5>
            <div className="flex items-center justify-between mb-1">
              <p className="text-color-gray">Subtotal:</p>
              <p className="text-sm font-semibold">{subtotal} USD</p>
            </div>

            <div className="flex items-center justify-between mb-1">
              <p className="text-color-gray">Shipping:</p>
              <p className="text-sm font-semibold">{shippingCost} USD</p>
            </div>

            <div className="flex items-center justify-between mb-6">
              <p className="text-color-gray">Discount:</p>
              <p className="text-sm font-semibold">{discount} USD</p>
            </div>

            <Divider className="mb-2" />
            <div className="flex items-center justify-between mb-6">
              <p className="text-sm font-semibold">Total</p>
              <p className="text-sm font-semibold">{total} USD</p>
            </div>
          </Paper>
        </Grid>
      </Grid>
    </div>
  );
};

export default OrderDetailInfo;
