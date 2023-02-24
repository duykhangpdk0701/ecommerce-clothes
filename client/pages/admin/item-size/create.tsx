import { useRouter } from "next/router";
import React, { ReactElement, useState } from "react";
import { NextPageWithLayout } from "@/pages/_app";
import * as yup from "yup";
import Head from "next/head";
import { useForm, SubmitHandler } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import { useMutation, useQuery } from "react-query";
import adminItemSizeAPI from "@/api/admin/adminItemSize";
import CreateItemSizeTemplate from "@/components/templates/admin/itemSize/create";
import AdminLayout from "@/layout/AdminLayout";
import adminItemCategoryAPI from "@/api/admin/adminItemCategoryAPI";
import adminItemPersonTypeAPI from "@/api/admin/adminItemPersonType";

export interface ICreateItemSizeParams {
  value: string;
  itemCategoryId: number;
  itemPersonTypeId: number;
  status: boolean;
  order: number;
}

const createItemSizeSchema = yup.object({
  value: yup.string().required(),
  itemCategoryId: yup.string().required(),
  itemPersonTypeId: yup.string().required(),
  status: yup.boolean().required(),
  order: yup.string().required(),
});

const CreateItemSize: NextPageWithLayout = () => {
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const {
    control,
    handleSubmit,
    formState: { errors },
  } = useForm<ICreateItemSizeParams>({
    defaultValues: {
      order: 0,
      status: true,
    },
    resolver: yupResolver(createItemSizeSchema),
  });

  const itemCatgoryQuery = useQuery(
    "item-category",
    adminItemCategoryAPI.getListOfItemCategory
  );

  const createItemSizeMutation = useMutation({
    mutationKey: "brand",
    mutationFn: ({
      value,
      order,
      itemCategoryId,
      itemPersonTypeId,
      status,
    }: ICreateItemSizeParams) => {
      setLoading(true);
      return adminItemSizeAPI.createItemSize(
        value,
        order,
        itemPersonTypeId,
        itemCategoryId,
        status
      );
    },
    onSuccess: (data) => {
      console.log(data);
      setLoading(false);
    },
    onError: (error: any) => {
      console.log(error);
      setLoading(false);
    },
  });

  const onSubmit: SubmitHandler<ICreateItemSizeParams> = (data) => {
    const { value, itemCategoryId, itemPersonTypeId, order, status } = data;
    console.log(data);
    createItemSizeMutation.mutate({
      value,
      order,
      itemPersonTypeId,
      itemCategoryId,
      status,
    });
  };

  return (
    <>
      <Head>
        <title>Item Size Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <CreateItemSizeTemplate
        control={control}
        handleSubmit={handleSubmit}
        onSubmit={onSubmit}
        errors={errors}
        isLoading={loading}
        errorResMessage={error}
        itemCategory={itemCatgoryQuery.data}
      />
    </>
  );
};

CreateItemSize.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default CreateItemSize;
