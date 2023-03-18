import adminItemSizeAPI from "@/api/admin/adminItemSize";
import ListItemSizeTemplate from "@/components/templates/admin/itemSize/list";
import AdminLayout from "@/layout/AdminLayout";
import Head from "next/head";
import React, { ReactElement, useEffect } from "react";
import { useQuery } from "react-query";
import { NextPageWithLayout } from "@/pages/_app";
import { useRouter } from "next/router";
import { useForm, SubmitHandler } from "react-hook-form";
import queryString from "query-string";

export interface IItemSizeListParams {
  search: string;
  rowPerPage: number;
  page: number;
}

const ItemSize: NextPageWithLayout = () => {
  const router = useRouter();

  const { control, handleSubmit, watch, getValues } =
    useForm<IItemSizeListParams>({
      defaultValues: {
        page: 0,
        rowPerPage: 5,
      },
    });

  const onSubmit: SubmitHandler<IItemSizeListParams> = (data) => {
    console.log(data);
  };

  const itemSizeQuery = useQuery({
    queryKey: ["item-size", router.isReady, router.query],
    queryFn: () => {
      if (router.isReady) {
        const searchUrl = router.query;
        const search = searchUrl.search as string | undefined;
        const limit = searchUrl.rowPerPage as number | undefined;
        const page = searchUrl.page
          ? parseInt(searchUrl.page as string)
          : undefined;
        return adminItemSizeAPI.getListOfItemSize(search, limit, page);
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
        <title>Item Size Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <ListItemSizeTemplate
        data={itemSizeQuery.data}
        control={control}
        handleSubmit={handleSubmit}
        onSubmit={onSubmit}
        watch={watch}
        isLoading={itemSizeQuery.isLoading}
      />
    </>
  );
};

ItemSize.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default ItemSize;
