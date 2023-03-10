import userAPI from "@/api/userAPI";
import ProfileTemplate from "@/components/templates/profile";
import AccountLayout from "@/layout/AccountLayout";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";
import ProfileInfo from "@/components/templates/profile/info";

const Profile: NextPageWithLayout = () => {
  const userQuery = useQuery({
    queryKey: "user",
    queryFn: () => userAPI.getUserDetail(),
  });

  return (
    <ProfileTemplate
      loading={userQuery.isLoading}
      profileInfor={<ProfileInfo data={userQuery.data} />}
    />
  );
};

Profile.getLayout = function getLayout(page: ReactElement) {
  return <AccountLayout>{page}</AccountLayout>;
};

export default Profile;
