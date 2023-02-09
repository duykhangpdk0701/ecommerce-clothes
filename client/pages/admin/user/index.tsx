import UserTemplate from "@/components/templates/admin/user";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement } from "react";
import { NextPageWithLayout } from "../../_app";

const User: NextPageWithLayout = () => {
  return (
    <>
      <Head>
        <title>User Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <UserTemplate />;
    </>
  );
};

User.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default User;
