import EditProfileTemplate from "@/components/templates/profile/edit";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement } from "react";
import { NextPageWithLayout } from "../../_app";

const EditProfile: NextPageWithLayout = () => {
  return <EditProfileTemplate />;
};

EditProfile.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default EditProfile;
