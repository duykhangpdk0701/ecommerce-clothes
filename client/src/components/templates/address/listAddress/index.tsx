import { LocationOn } from "@mui/icons-material";
import { Button } from "@mui/material";
import Link from "next/link";
import React, { FC, Fragment } from "react";
import ListAddressItems from "./ListAddressItems";

interface IListAddressTemplate {}

const addressItem = [
  <ListAddressItems />,
  <ListAddressItems />,
  <ListAddressItems />,
];

const ListAddressTemplate: FC<IListAddressTemplate> = (props) => {
  return (
    <div>
      <div className="mt-4 mb-6 flex justify-between">
        <div className="flex gap-3 items-center">
          <LocationOn className="text-2xl" />
          <h2 className="text-2xl">Addresses</h2>
        </div>

        <div>
          <Link href="address/add" className="no-underline">
            <Button className="px-8 font-medium" variant="text">
              Add New Address
            </Button>
          </Link>
        </div>
      </div>

      {addressItem.map((item, index) => (
        <div key={index}>{item}</div>
      ))}
    </div>
  );
};

export default ListAddressTemplate;
