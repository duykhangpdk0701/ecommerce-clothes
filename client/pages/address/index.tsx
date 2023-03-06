import addressAPI from "@/api/address";
import destinationAPI from "@/api/destinationAPI";
import ListAddressTemplate from "@/components/templates/address/listAddress";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";

const Address = () => {
  const addressquery = useQuery("addrress", addressAPI.getList);
  return <ListAddressTemplate data={addressquery.data} />;
};

Address.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default Address;
