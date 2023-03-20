import PersonIcon from "@mui/icons-material/Person";
import Button from "@mui/material/Button";

import Link from "next/link";
import React, { FC, ReactElement } from "react";
import InforLoading from "./info/loading";

interface IProfileTemplate {
  profileInfor: ReactElement;
  loading: boolean;
}

const ProfileTemplate: FC<IProfileTemplate> = (props) => {
  const { profileInfor, loading } = props;
  return (
    <div>
      <div className="mt-4 mb-6">
        <div className="flex gap-3 items-center justify-between">
          <div className="flex gap-3 items-center">
            <PersonIcon className="text-2xl text-color-price" />
            <h2 className="text-2xl">My Profile</h2>
          </div>

          <div>
            <Button LinkComponent={Link} href={`/profile/edit`}>
              Edit Profile
            </Button>
          </div>
        </div>
      </div>

      {loading ? <InforLoading /> : profileInfor}
    </div>
  );
};

export default ProfileTemplate;
