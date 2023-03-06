import DeleteIcon from "@mui/icons-material/Delete";
import EditIcon from "@mui/icons-material/Edit";
import { IconButton, Paper } from "@mui/material";
import Link from "next/link";
import React, { FC } from "react";

interface IListAddressItems {
  id: number;
  address: string;
  addressToString: string;
  phone: string;
  name: string;
}

const ListAddressItems: FC<IListAddressItems> = (props) => {
  const { id, address, addressToString, phone, name } = props;
  return (
    <Link href={`address/${id}`} className="no-underline">
      <Paper className="my-4 py-1.5 px-4 flex items-center">
        <p className="flex-1">{name}</p>
        <p className="flex-[1_1_260px] pr-10 whitespace-nowrap text-ellipsis overflow-hidden">
          {address}, {addressToString}
        </p>
        <p className="flex-1">{phone}</p>
        <p>
          <IconButton>
            <EditIcon className="text-xl" />
          </IconButton>
          <IconButton>
            <DeleteIcon className="text-xl" />
          </IconButton>
        </p>
      </Paper>
    </Link>
  );
};

export default ListAddressItems;
