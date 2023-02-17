import adminBrandAPI from "@/api/admin/adminBrandAPI";
import ListBrandTemplate from "@/components/templates/admin/brand/ListBrand";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import { useRouter } from "next/router";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "../../_app";

const Brand: NextPageWithLayout = () => {
  const route = useRouter();
  const brandQuery = useQuery({
    queryKey: "brand",
    queryFn: adminBrandAPI.getListOfBrand,
    onError(err: any) {
      console.log(err.code);
      const code = err.code;
      if (code === 401) {
        // route.replace("/auth/login");
      }
    },
  });

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
