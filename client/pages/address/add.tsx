import destinationAPI from "@/api/destinationAPI";
import AddAddressTemplate from "@/components/templates/address/addAddress";
import AddAddressForm from "@/components/templates/address/addAddress/AddAddressForm";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";

const AddAddress = () => {
  const citesQuery = useQuery("city", destinationAPI.getListOfCites);

  return (
    <AddAddressTemplate
      addAddressForm={
        <AddAddressForm
          cities={citesQuery.data}
          loading={citesQuery.isLoading}
        />
      }
    />
  );
};

AddAddress.getLayout = function (page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default AddAddress;
