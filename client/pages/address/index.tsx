import destinationAPI from "@/api/destinationAPI";
import ListAddressTemplate from "@/components/templates/address/listAddress";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";

const Address = () => {
  const query = useQuery("city", destinationAPI.getListOfCites);
  return <ListAddressTemplate />;
};

Address.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default Address;
