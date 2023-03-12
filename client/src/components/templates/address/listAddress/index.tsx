import IAddress from "@/interfaces/Address";
import LocationOnIcon from "@mui/icons-material/LocationOn";
import Button from "@mui/material/Button";
import Link from "next/link";
import React, { FC } from "react";
import ListAddressItemLoading from "./ListAddressItemLoading";
import ListAddressItems from "./ListAddressItems";

interface IListAddressTemplate {
  data?: IAddress[];
  loading: boolean;
}

const listItem = [
  <ListAddressItemLoading />,
  <ListAddressItemLoading />,
  <ListAddressItemLoading />,
  <ListAddressItemLoading />,
  <ListAddressItemLoading />,
];

const ListAddressTemplate: FC<IListAddressTemplate> = (props) => {
  const { data, loading } = props;
  return (
    <div>
      <div className="mt-4 mb-6 flex justify-between">
        <div className="flex gap-3 items-center">
          <LocationOnIcon className="text-2xl text-color-price" />
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
      {loading
        ? listItem
        : data?.map((item, index) => (
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
