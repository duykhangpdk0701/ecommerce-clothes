import { Delete, Edit } from "@mui/icons-material";
import { IconButton, Paper } from "@mui/material";
import Link from "next/link";
import React from "react";

const ListAddressItems = () => {
  return (
    <Link href="/orders/f111" className="no-underline">
      <Paper className="my-4 py-1.5 px-4 flex items-center">
        <p className="flex-1">Office</p>
        <p className="flex-[1_1_260px]">497 Erdman Passage, New Zoietown</p>
        <p className="flex-1">(213) 840-9416</p>
        <p>
          <IconButton>
            <Edit className="text-xl" />
          </IconButton>
          <IconButton>
            <Delete className="text-xl" />
          </IconButton>
        </p>
      </Paper>
    </Link>
  );
};

export default ListAddressItems;
