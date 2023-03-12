import adminItemStockAPI from "@/api/admin/adminItemStockAPI";
import CreateItemStockTemplate from "@/components/templates/admin/itemStock/create";
import { setSnackbar } from "@/contexts/slices/snackbarSlice";
import { useAppDispatch } from "@/hooks/redux";
import AdminLayout from "@/layout/AdminLayout";
import { NextPageWithLayout } from "@/pages/_app";
import { yupResolver } from "@hookform/resolvers/yup";
import Head from "next/head";
import { useRouter } from "next/router";
import React, { ReactElement, useState } from "react";
import { SubmitHandler, useFieldArray, useForm } from "react-hook-form";
import { useMutation } from "react-query";
import * as yup from "yup";

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

const createItemStockSchema = yup.object({
  inboundItem: yup.array().of(
    yup.object({
      itemVariantId: yup.number().required(),
      priceIn: yup.number().required(),
      price: yup.number().required(),
      stockStatusId: yup.number().required(),
      quantity: yup.number().required(),
    })
  ),
});

const CreateItemStock: NextPageWithLayout = () => {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const router = useRouter();

  const dispatch = useAppDispatch();

  const {
    control,
    handleSubmit,
    getValues,
    watch,
    setValue,
    formState: { errors },
  } = useForm<ICreateItemStockParams>({
    defaultValues: {
      itemInBound: [
        {
          itemId: undefined,
          itemVariantId: undefined,
          priceIn: undefined,
          price: undefined,
          stockStatusId: undefined,
          quantity: undefined,
        },
      ],
    },

    resolver: yupResolver(createItemStockSchema),
  });

  const { fields, append, remove } = useFieldArray({
    control,
    name: "itemInBound",
  });

  const addItemStock = useMutation({
    mutationKey: ["item-stock"],
    mutationFn: ({ inboundItem }: IAddItemStock) =>
      adminItemStockAPI.addItemStock(inboundItem),
    onSuccess: async () => {
      await router.push("/item-stock");
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "success",
          snackbarMessage: "Create Address successfully",
        })
      );
      router.push("/address");
    },
    onError: (error: any) => {
      dispatch(
        setSnackbar({
          snackbarOpen: true,
          snackbarType: "error",
          snackbarMessage: error.message,
        })
      );
    },
  });

  const onSubmit: SubmitHandler<ICreateItemStockParams> = (data) => {
    const { itemInBound } = data;
    console.log(itemInBound);
    setLoading(true);
    addItemStock.mutateAsync({
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
    setLoading(false);
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
        watch={watch}
        setValue={setValue}
      />
    </>
  );
};

CreateItemStock.getLayout = function getLayout(page: ReactElement) {
  return <AdminLayout>{page}</AdminLayout>;
};

export default CreateItemStock;
