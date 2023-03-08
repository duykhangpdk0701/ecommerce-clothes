import LocationOnIcon from "@mui/icons-material/LocationOn";
import React, { FC, ReactNode } from "react";
import Link from "next/link";
import Button from "@mui/material/Button";

interface IUpdateAddressTemplate {
  addAddressForm: ReactNode;
}

const UpdateAddressTemplate: FC<IUpdateAddressTemplate> = (props) => {
  const { addAddressForm } = props;

  return (
    <div>
      <div className="mt-4 mb-6 flex justify-between">
        <div className="flex gap-3 items-center">
          <LocationOnIcon className="text-2xl" />
          <h2 className="text-2xl">Update Address</h2>
        </div>

        <div>
          <Link href="/address" className="no-underline">
            <Button className="px-8 font-medium" variant="text">
              Back To Address
            </Button>
          </Link>
        </div>
      </div>

      {addAddressForm}
    </div>
  );
};

export default UpdateAddressTemplate;
