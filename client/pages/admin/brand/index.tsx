import adminBrandAPI from "@/api/admin/adminBrandAPI";
import ListBrandTemplate from "@/components/templates/admin/brand/ListBrand";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import { useRouter } from "next/router";
import React, { ReactElement, useEffect } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";
import { useForm, SubmitHandler } from "react-hook-form";
import queryString from "query-string";

export interface IBrandListParams {
  search: string;
  rowPerPage: number;
  page: number;
}

const Brand: NextPageWithLayout = () => {
  const router = useRouter();

  const { control, handleSubmit, watch, getValues } = useForm<IBrandListParams>(
    {
      defaultValues: {
        page: 0,
        rowPerPage: 5,
      },
    }
  );

  const onSubmit: SubmitHandler<IBrandListParams> = (data) => {
    console.log(data);
  };

  const brandQuery = useQuery({
    queryKey: ["brand", router.isReady, router.query],
    queryFn: () => {
      if (router.isReady) {
        const searchUrl = router.query;
        const search = searchUrl.search as string | undefined;
        const limit = searchUrl.rowPerPage as number | undefined;
        const page = searchUrl.page
          ? parseInt(searchUrl.page as string)
          : undefined;
        return adminBrandAPI.getListOfBrand(search, limit, page);
      }
      return undefined;
    },
    onError(err: any) {
      const code = err.code;
      if (code === 401) {
        router.replace("/auth/login");
      }
    },
  });

  useEffect(() => {
    watch(async (value) => {
      const stringUrl = queryString.stringify(value);
      await router.push(
        { query: queryString.parse(stringUrl) as any },
        undefined,
        {
          shallow: true,
        }
      );
    });
  }, []);

  return (
    <>
      <Head>
        <title>Brand Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListBrandTemplate
        data={brandQuery.data}
        control={control}
        handleSubmit={handleSubmit}
        onSubmit={onSubmit}
        watch={watch}
        isLoading={brandQuery.isLoading}
      />
    </>
  );
};

Brand.getLayout = function getlayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default Brand;
