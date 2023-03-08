import EastIcon from "@mui/icons-material/East";
import Chip from "@mui/material/Chip";
import IconButton from "@mui/material/IconButton";
import Paper from "@mui/material/Paper";
import moment from "moment";

import Link from "next/link";
import React, { FC } from "react";

interface IListOrderItems {
  id: number;
  orderCode: string;
  total: string;
  dateCreate: string;
  status: number;
}

const ListOrderItems: FC<IListOrderItems> = (props) => {
  const { id, orderCode, total, dateCreate } = props;

  return (
    <Link href={`/order/${orderCode}`} className="no-underline">
      <Paper className="my-4 py-1.5 px-4 flex items-center">
        <h5 className="flex-1 text-base whitespace-nowrap text-ellipsis overflow-hidden">
          {orderCode.replace("ECOMMERCE-", "")}
        </h5>
        <div className="flex-1">
          <Chip className="h-6" label="Pending" />
        </div>
        <p className="flex-1">{moment(dateCreate).format("MMM Do YY")}</p>
        <p className="flex-1">{total} US$</p>
        <p>
          <IconButton>
            <EastIcon className="text-xl" />
          </IconButton>
        </p>
      </Paper>
    </Link>
  );
};

export default ListOrderItems;
