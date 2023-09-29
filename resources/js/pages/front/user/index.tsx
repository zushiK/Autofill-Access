import AppLayout from "@/features/layout/AppLayout";
import { UserType } from "@/types/UserType";
import { Head } from "@inertiajs/react";

type LocalType = {
  datas: UserType[];
};

export default function index(props: LocalType) {
  return (
    <>
      <Head title="APP" />
      <AppLayout>
        {props.datas?.data.map(data => (
          <div key={data.id}>{data.name}</div>
        ))}
      </AppLayout>
    </>
  );
}
