import EastIcon from "@mui/icons-material/East";
import Chip from "@mui/material/Chip";
import IconButton from "@mui/material/IconButton";
import Paper from "@mui/material/Paper";

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
            <EastIcon className="text-xl" />
          </IconButton>
        </p>
      </Paper>
    </Link>
  );
};

export default ListOrderItems;
