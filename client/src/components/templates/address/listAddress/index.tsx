import IAddress from "@/interfaces/Address";
import LocationOnIcon from "@mui/icons-material/LocationOn";
import { Button } from "@mui/material";
import Link from "next/link";
import React, { FC } from "react";
import ListAddressItems from "./ListAddressItems";

interface IListAddressTemplate {
  data?: IAddress[];
}

const ListAddressTemplate: FC<IListAddressTemplate> = (props) => {
  const { data } = props;
  return (
    <div>
      <div className="mt-4 mb-6 flex justify-between">
        <div className="flex gap-3 items-center">
          <LocationOnIcon className="text-2xl" />
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

      {data?.map((item, index) => (
        <div key={index}>
          <ListAddressItems
            id={item.id}
            address={item.address}
            addressToString={item.parse_address_string}
            phone={item.phone}
            name={item.name}
          />
        </div>
      ))}
    </div>
  );
};

export default ListAddressTemplate;
