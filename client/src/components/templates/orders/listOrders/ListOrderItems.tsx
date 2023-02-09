import { East } from "@mui/icons-material";
import { Chip, IconButton, Paper } from "@mui/material";
import Link from "next/link";
import React from "react";

const ListOrderItems = () => {
  return (
    <Link href="/orders/f111" className="no-underline">
      <Paper className="my-4 py-1.5 px-4 flex items-center">
        <h5 className="flex-1 text-base">f0ba538b</h5>
        <div className="flex-1">
          <Chip className="h-6" label="Pending" />
        </div>
        <p className="flex-1">Nov 10, 2022</p>
        <p className="flex-1">350,00 US$</p>
        <p>
          <IconButton>
            <East className="text-xl" />
          </IconButton>
        </p>
      </Paper>
    </Link>
  );
};

export default ListOrderItems;
