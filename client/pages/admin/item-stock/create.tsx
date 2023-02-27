import adminItemAPI from "@/api/admin/adminItemAPI";
import adminItemStockAPI from "@/api/admin/adminItemStockAPI";
import CreateItemStockTemplate from "@/components/templates/admin/itemStock/create";
import AdminLayout from "@/layout/AdminLayout";
import { NextPageWithLayout } from "@/pages/_app";
import Head from "next/head";
import React, { ReactElement, useState } from "react";
import { SubmitHandler, useFieldArray, useForm } from "react-hook-form";
import { useMutation, useQuery } from "react-query";

export interface ICreateItemStockParams {
  itemInBound: [
    {
      itemId: number;
      itemVariantId: number;
      priceIn: number;
      price: number;
      stockStatusId: number;
      quantity: number;
    }
  ];
}

interface IAddItemStock {
  inboundItem: {
    itemVariantId: number;
    priceIn: number;
    price: number;
    stockStatusId: number;
    quantity: number;
  }[];
}

const CreateItemStock: NextPageWithLayout = () => {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const {
    control,
    handleSubmit,
    getValues,
    formState: { errors },
  } = useForm<ICreateItemStockParams>({
    defaultValues: {
      itemInBound: [
        {
          itemId: undefined,
          itemVariantId: undefined,
          priceIn: 100000,
          price: 200000,
          stockStatusId: 1,
          quantity: 1,
        },
      ],
    },
  });

  const { fields, append, remove } = useFieldArray({
    control,
    name: "itemInBound",
  });

  const addItemStock = useMutation({
    mutationKey: ["item-stock"],
    mutationFn: ({ inboundItem }: IAddItemStock) =>
      adminItemStockAPI.addItemStock(inboundItem),
    onSuccess: () => {
      setLoading(false);
    },
    onError: () => {
      setLoading(false);
    },
  });

  const onSubmit: SubmitHandler<ICreateItemStockParams> = (data) => {
    const { itemInBound } = data;
    console.log(itemInBound);
    setLoading(true);
    addItemStock.mutate({
      inboundItem: itemInBound.map(
        ({ itemVariantId, priceIn, price, quantity }) => ({
          itemVariantId,
          priceIn,
          price,
          stockStatusId: 1,
          quantity,
        })
      ),
    });
  };

  return (
    <>
      <Head>
        <title>Item Stock Management | DBRR store</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="/favicon.ico" />
      </Head>
      <CreateItemStockTemplate
        fields={fields}
        append={append}
        remove={remove}
        control={control}
        errors={errors}
        errorResMessage={error}
        handleSubmit={handleSubmit}
        isLoading={loading}
        onSubmit={onSubmit}
        getValues={getValues}
      />
    </>
  );
};

CreateItemStock.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default CreateItemStock;
