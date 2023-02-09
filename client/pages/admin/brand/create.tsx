import CreateBrandTemplate from "@/components/templates/admin/brand/CreateBrand";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement } from "react";
import { NextPageWithLayout } from "../../_app";

const CreateBrand: NextPageWithLayout = () => {
  return (
    <>
      <Head>
        <title>Brand Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <CreateBrandTemplate />
    </>
  );
};

CreateBrand.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default CreateBrand;
