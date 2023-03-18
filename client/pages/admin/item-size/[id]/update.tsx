import { useRouter } from "next/router";
import React, { ReactElement, useState } from "react";
import { NextPageWithLayout } from "@/pages/_app";
import * as yup from "yup";
import Head from "next/head";
import { useForm, SubmitHandler } from "react-hook-form";
import { yupResolver } from "@hookform/resolvers/yup";
import { useMutation, useQuery } from "react-query";
import adminItemSizeAPI from "@/api/admin/adminItemSize";
import AdminLayout from "@/layout/AdminLayout";
import adminItemCategoryAPI from "@/api/admin/adminItemCategoryAPI";
import UpdateItemSizeTemplate from "@/components/templates/admin/itemSize/update";

export interface IUpdateItemSizeParams {
  value: string;
  itemCategoryId: number;
  itemPersonTypeId: number;
  status: boolean;
  order: number;
}

const updateItemSizeSchema = yup.object({
  value: yup.string().required(),
  itemCategoryId: yup.string().required(),
  itemPersonTypeId: yup.string().required(),
  status: yup.boolean().required(),
  order: yup.string().required(),
});

const UpdateItemSize: NextPageWithLayout = () => {
  const router = useRouter();
  const { id } = router.query;
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const {
    control,
    handleSubmit,
    setValue,
    formState: { errors },
  } = useForm<IUpdateItemSizeParams>({
    defaultValues: {
      order: 0,
      value: "",
      status: true,
    },
    resolver: yupResolver(updateItemSizeSchema),
  });

  const itemCatgoryQuery = useQuery({
    queryKey: ["item-category"],
    queryFn: () => adminItemCategoryAPI.getListOfItemCategory(),
  });

  const itemSizeQuery = useQuery({
    queryKey: ["item-size", id],
    queryFn: () => {
      setLoading(true);
      if (id && typeof id !== "object") {
        return adminItemSizeAPI.getItemSizeById(id);
      }
      return;
    },
    onSuccess: (data) => {
      data?.value && setValue("value", data.value);
      data?.item_category && setValue("itemCategoryId", data.item_category.id);
      data?.item_person_type &&
        setValue("itemPersonTypeId", data.item_person_type.id);
      data?.order && setValue("order", parseInt(data.order));
      data?.status && setValue("status", data.status);
      setLoading(false);
    },
    onError: (error: any) => {
      console.log(error);
      setLoading(false);
    },
  });

  const updateItemSizeMutation = useMutation({
    mutationKey: "item-size",
    mutationFn: ({
      value,
      order,
      itemCategoryId,
      itemPersonTypeId,
      status,
    }: IUpdateItemSizeParams) => {
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

  const onSubmit: SubmitHandler<IUpdateItemSizeParams> = (data) => {
    const { value, itemCategoryId, itemPersonTypeId, order, status } = data;
    console.log(data);
    updateItemSizeMutation.mutate({
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
      <UpdateItemSizeTemplate
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

UpdateItemSize.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default UpdateItemSize;
