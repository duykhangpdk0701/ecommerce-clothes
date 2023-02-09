import ProfileTemplate from "@/components/templates/profile";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement } from "react";
import { NextPageWithLayout } from "../_app";

const Profile: NextPageWithLayout = () => {
  return <ProfileTemplate />;
};

Profile.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default Profile;
