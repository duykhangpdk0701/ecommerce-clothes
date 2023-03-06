import AccountLayout from "@/layout/AccountLayout";
import { NextPageWithLayout } from "@/pages/_app";
import React, { ReactElement } from "react";

const AddressDetail: NextPageWithLayout = () => {
  return <div>AddressDetail</div>;
};

AddressDetail.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default AddressDetail;
