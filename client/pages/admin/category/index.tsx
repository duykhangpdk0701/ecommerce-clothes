import brandAPI from "@/api/brandAPI";
import categoryAPI from "@/api/categoryAPI";
import ListBrandTemplate from "@/components/templates/admin/brand/ListBrand";
import ListCategoryTemplate from "@/components/templates/admin/category/ListCategory";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "../../_app";

const Category: NextPageWithLayout = () => {
  const categoryQuery = useQuery("listCategory", categoryAPI.getListOfCategory);

  return (
    <>
      <Head>
        <title>Category Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListCategoryTemplate data={categoryQuery.data} />
    </>
  );
};

Category.getLayout = function getlayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default Category;
