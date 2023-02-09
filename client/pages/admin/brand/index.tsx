import adminBrandAPI from "@/api/admin/AdminAPI";
import brandAPI from "@/api/brandAPI";
import ListBrandTemplate from "@/components/templates/admin/brand/ListBrand";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "../../_app";

const Brand: NextPageWithLayout = () => {
  const brandQuery = useQuery("listBrand", adminBrandAPI.getListOfBrand);

  return (
    <>
      <Head>
        <title>Brand Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListBrandTemplate data={brandQuery.data} />
    </>
  );
};

Brand.getLayout = function getlayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default Brand;
