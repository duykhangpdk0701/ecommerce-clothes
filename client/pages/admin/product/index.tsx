import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement, useEffect } from "react";
import { NextPageWithLayout } from "@/pages/_app";
import ListProductTemplate from "@/components/templates/admin/product/ListProduct";
import { useQuery } from "react-query";
import adminItemAPI from "@/api/admin/adminItemAPI";
import { useForm, SubmitHandler } from "react-hook-form";
import { useRouter } from "next/router";
import queryString from "query-string";

export interface IProductListParams {
  search: string;
  rowPerPage: number;
  page: number;
}

const Product: NextPageWithLayout = () => {
  const router = useRouter();
  const { control, handleSubmit, watch, getValues } =
    useForm<IProductListParams>({
      defaultValues: {
        page: 0,
        rowPerPage: 5,
      },
    });

  const onSubmit: SubmitHandler<IProductListParams> = (data) => {
    console.log(data);
  };

  const listProductQuery = useQuery({
    queryKey: ["products", router.isReady, router.query],
    queryFn: () => {
      if (router.isReady) {
        const searchUrl = router.query;
        const search = searchUrl.search as string | undefined;
        const limit = searchUrl.rowPerPage as number | undefined;
        const page = searchUrl.page
          ? parseInt(searchUrl.page as string)
          : undefined;
        return adminItemAPI.getListOfItem(search, limit, page);
      }
      return undefined;
    },
    onError: (err: any) => {
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
        <title>Product Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListProductTemplate
        data={listProductQuery.data}
        control={control}
        handleSubmit={handleSubmit}
        onSubmit={onSubmit}
        watch={watch}
      />
    </>
  );
};

Product.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default Product;
