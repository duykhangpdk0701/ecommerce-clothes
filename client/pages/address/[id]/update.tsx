import AccountLayout from "@/layout/AccountLayout";
import { NextPageWithLayout } from "@/pages/_app";
import React, { ReactElement } from "react";

const UpdateAddress: NextPageWithLayout = () => {
  return <div>UpdateAddress</div>;
};

UpdateAddress.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default UpdateAddress;
