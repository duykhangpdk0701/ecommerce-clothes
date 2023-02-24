import adminUserAPI from "@/api/admin/adminUserAPI";
import UserTemplate from "@/components/templates/admin/user";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";

const User: NextPageWithLayout = () => {
  const userQuery = useQuery("user", adminUserAPI.getListOfUser);
  return (
    <>
      <Head>
        <title>User Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <UserTemplate data={userQuery.data} />;
    </>
  );
};

User.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default User;
